<?php
namespace Helpers\AdminLTE;

/*
 * InfoBox
 *
 * @author David Kinders
 * @date 26/07/2015 
 */

class InfoBox extends AdminLTE {
    
    public $text = null;
    public $content = null;
    // visuals
    public $icon = "fa fa-info";
    public $witdh = 2;
    public $color = null;

    public function render() {
        $html = '
        <div class="col-md-' . $this->witdh . '">
            <div class="info-box">
              <span class="info-box-icon bg-'.$this->color.'"><i class="'.$this->icon.'"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">'.$this->text.'</span>
                <span class="info-box-number">'.$this->content.'</span>
              </div>
            </div>
        </div>';
        return $html;
    }

}
