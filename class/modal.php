<?php
require('module/common.php');
class Modal
{

  private $conn;
  public static $counter = 0;
  public  $title = 'Modal_Title';
  public  $id = 'modal_id_';
  public  $form_name = 'form_name_';
  public  $submit_show   = true;
  public  $submit_id   = 'submit_id_';
  public  $submit_text = 'Submit';
  public  $cancel_show   = true;
  public  $cancel_id = 'cancel_id_';
  public  $cancel_text = 'Cancel';
  public  $method = 'POST';

  public function __construct($db)
  {
    self::$counter++;
    $this->form_name = $this->form_name . self::$counter;
    $this->conn = $db;
  }

  public function create_modal($url)
  {
    $modal = '<div class="modal fade" id="' . $this->id . '" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
          <form name="' . $this->form_name . '" method="' . $this->method . '">
         <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
             <div class="modal-header bg-dark text-white">
               <h5 class="modal-title" >' . $this->title . '</h5>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">';
    $modal   .= get_contents($url);
    $modal   .= '</div>
             <div class="modal-footer">';

    $modal .= (!$this->cancel_show) ? '' : '<button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal"> ' . $this->cancel_text . ' <i class="fa fa-close"></i></button>';
    $modal .= (!$this->submit_show) ? '' : '<button type="submit" class="btn btn-sm btn-warning">' . $this->submit_text . ' <i class="fa fa-check"></i></button>';
    $modal .= '            
            </div>
          </div>
        </div>
      </form>
      </div>';
    return $modal;
  }
}
