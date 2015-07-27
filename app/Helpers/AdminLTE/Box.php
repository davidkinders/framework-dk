<?php
namespace Helpers\AdminLTE;
use Core\Rbac;

/*
 * Box
 *
 * @author David Kinders
 * @date 25/07/2015 
 */

class Box extends AdminLTE {

    public $title = null;
    public $body = null;
    public $footer = null;
    // visuals
    public $witdh = 3;
    public $collapsable = true;
    public $removable = true;
    public $border = true;
    public $color = "default";
    private $tools;

    public function addTool($tool, $rbac = null) {
        $this->tools[] = ['tool' => $tool, 'rbac' => $rbac];
    }

    public function render() {
        if ($this->border) {
            $border = "box box-" . $this->color;
        } else {
            $border = "box box-solid box-" . $this->color;
        }

        $html = '
            <div class="col-md-' . $this->witdh . '">      
                <div class="' . $border . '">
                    <div class="box-header">
                      <h3 class="box-title">' . $this->title . '</h3>
                      <div class="box-tools pull-right">';
        if (is_array($this->tools)) {
            foreach ($this->tools as $tool) {
                if (Rbac::canUser($tool['rbac']) OR $tool['rbac'] == null) {
                    $html .= $tool['tool'];
                }
            }
        }
        $html .= '                
                      </div>
                    </div>
                    <div class="box-body">
                      ' . $this->body . '
                    </div>';
        if ($this->footer <> null) {
            $html .= '
                    <div class="box-footer">
                      ' . $this->footer . '
                    </div>';
        }
        $html .= '
                </div>
            </div>';
        return $html;
    }

}
