<div class="modal fade bd-example-modal-sm" id="change-pass-conf-modal" tabindex="-1" role="dialog"aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation <i class="fa fa-question-circle-o pull-right" aria-hidden="true"></i> </h5>
      </div>
      <div class="modal-body text-center">
          <i class="fa fa-question-circle-o fa-3x"></i><br>
          Would you like to save your new password?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="change-password-btn">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="approval-modal" tabindex="-1" role="dialog"aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation </h5>
      </div>
      <div class="modal-body text-center" id="approval-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="approveBtnClick()" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="save-changes-modal" tabindex="-1" role="dialog"aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
      </div>
      <div class="modal-body text-center">
         <i class="fa fa-question-circle-o fa-4x" aria-hidden="true"></i> <br><br>
        Would you like to save its changes?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="saveChangesBtnClick()">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="confirmation-modal" tabindex="-1" role="dialog"aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation <i class="fa fa-question-circle-o pull-right" aria-hidden="true"></i> </h5>
      </div>
      <div class="modal-body text-center">
          <i class="fa fa-question-circle-o fa-3x"></i><br>
          Would you like to continue?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirm-yes-btn">Yes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#change-password-btn').click(function () {
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      var password = $('#first-password').val();
      var con_password = $('#first-confirm-password').val();

      $.ajax({ 
        type: "POST",
        url: "../controls/univ/cls_upd_password.php",
        data: {
          user_id:user_id, 
          password:password
        },
        success: function(response){
            $.ajax({ 
              type: "POST",
              url: "../controls/auth/logout.php",
              success: function(response){
                $('#change-pass-conf-modal').modal('toggle');
                $('#logout-dialog-modal').modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError){
                  alert(thrownError);
              }
            });
          },
        error: function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
      }
    });
  });
</script>