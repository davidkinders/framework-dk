<?php
namespace Helpers\AdminLTE;
/*
 * InfoBox
 *
 * @author David Kinders
 * @date 26/07/2015 
 */

class InfoBox2 extends AdminLTE {
    
    public $text = null;
    public $content = null;
    // visuals
    public $icon = "fa fa-info";
    public $witdh = 3;
    public $color = null;
    public $progress = 50;
    public $description = null;
    

    public function render() {
        $html = '
        <div class="col-md-' . $this->witdh . '">            
            <div class="info-box bg-'.$this->color.'">
              <span class="info-box-icon"><i class="'.$this->icon.'"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">'.$this->text.'</span>
                <span class="info-box-number">'.$this->content.'</span>
                <div class="progress">
                  <div class="progress-bar" style="width: '.$this->progress.'%"></div>
                </div>
                <span class="progress-description">
                  '.$this->description.'
                </span>
              </div>
            </div>
            </div>';                
        return $html;
    }
}
