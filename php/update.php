<!-- Modal update -->
<div class="modal fade" id="updatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="get">
          <div class="modal-body">

            <input type="text" name="update_type" value="">
            <input type="date" name="update_date" value="">
            <select name="update_etage" id="update_etage">
              <option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <input type="button" name="update-btn" id="update-btn" class="btn btn-warning" value ="Modifier">
            <input type="hidden" name="updateId" value="">
        </form>
      </div>
    </div>
  </div>
  </div>