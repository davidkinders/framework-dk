<?php
namespace Helpers\AdminLTE;

use Core\Rbac;
use Helpers\Url;
use Helpers\AdminLTE\Assets;

class DataTable extends AdminLTE {

    private $db = "";
    private $id = 'test';
    private $query = '';
    private $columns = "";
    private $links = [];
    private $html = "";
    public $rbac = ["string" => "", "databaseField" => "false"];
    public $languageFile = "static/nederlands.txt";
    public $linkColumWidth = "auto";
    public $dataTableDisabled = false;

    function __construct($query) {
        $this->query = $query;
        $this->id = md5(time());
        $this->db = \Helpers\Database::get();
    }

    function dataTable() {
        Assets::addToFooter("js", Url::templatePath() . "plugins/datatables/jquery.dataTables.min.js");
        Assets::addToFooter("js", Url::templatePath() . "plugins/datatables/dataTables.bootstrap.min.js");
        Assets::addToFooter("js", Url::templatePath() . "plugins/slimScroll/jquery.slimscroll.min.js");

        $script = "
                <script>
                    jQuery(document).ready(function(){
                    var table = $(\"#" . $this->id . "\").dataTable(
                    {";

        if (isset($this->languageFile)) {
            if (file_exists("$_SERVER[DOCUMENT_ROOT]/$this->languageFile")) {
                $script .= "\n                    \"oLanguage\": {\"sUrl\": \"/$this->languageFile\"},";
            }
        }
        $script .= "
                        \"aLengthMenu\": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, \"alle\"]],
                        \"iDisplayLength\": 10,
                        \"paging\":true,
                    });
                    });
                 </script>";

        Assets::addFooterScript($script);
    }

    function addColumn($dbcolumn, $caption, $type = text, $width = "", $align = "left") {
        $this->columns[] = ['dbcolumn' => $dbcolumn, 'caption' => $caption, 'type' => $type, 'width' => $width, 'align' => $align];
    }

    function addLink($link, $id, $caption, $icon = "", $color = "", $rbac = "") {
        $this->links[] = ['link' => $link, 'id' => $id, 'caption' => $caption, 'icon' => $icon, 'color' => $color, 'rbac' => $rbac];
    }

    function render() {

        $this->html = '
                                <div class="table-scrollable table-scrollable-borderless" style="overflow-x: hidden;">
                                    <table class="table table-hover table-light" id="' . $this->id . '">
                                     <thead>
                                      <tr class="uppercase">';

        // columns ophalen
        foreach ($this->columns as $column) {
            $this->html .= "    
                                        <th>
                                             $column[caption]
                                        </th>";
        }
        // kijken of er links zijn
        if (count($this->links) <> 0) {
            $this->html .= '    
                                        <th class="fit">
                                             
                                        </th>';
        }

        $this->html .= '
                                      </tr>
                                     </thead>';
        // Rows ophalen

        $data = $this->db->select($this->query);

        foreach ($data as $row) {

            $field = $this->rbac['databaseField'];


            $this->html .= '<tr>'; // ROW
            foreach ($this->columns as $column) {
                $field = $column["dbcolumn"];
                $this->html .= "\t\t\t\t<td align=\"$column[align]\">" . $row->$field . "</td>\r\n";
            }

            if (count($this->links) <> 0) {
                $this->html .= '<td align="right">';

                foreach ($this->links as $link) {

                    if (Rbac::canUser($link['rbac'])) {
                        $field = $link["id"];
                        $linkFull = str_ireplace("%parm%", $row->$field, $link["link"]);

                        $this->html .= " <a class=\"btn btn-xs bg-$link[color]\" href=\"$linkFull\"><i class=\"$link[icon]\"></i> $link[caption]</a>";

                        }
                }
                $this->html .= '</td>';
            }

            $this->html .= '</tr>'; // ROW                
        }

        $this->html .= '
                                    </table>
                                </div>';
        $this->html .= '
                ';

        return $this->html;

    }

}
