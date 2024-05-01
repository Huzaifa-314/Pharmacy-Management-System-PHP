<?php include 'include/header.php'; ?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Category
      </h3>
    </div>

    <div class="contents">
      <div class="row">
        <div class="col-lg-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add New Category</h4>
              <form class="forms-sample">
                <div class="form-group">
                  <label for="exampleInputName1">Category Name</label>
                  <input type="text" class="form-control" id="exampleInputName1" placeholder="Category Name">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Large select</label>
                  <select class="form-control form-control-lg" id="exampleFormControlSelect1">
                    <option>1</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>File upload</label>
                  <input type="file" name="img[]" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Add Category</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">All Categories</h4>

              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td><img width="40px " height="40px" alt=""></td>
                      <td> Syrup </td>
                      <td>
                        <div class="badge badge-success badge-pill">active</div>
                      </td>
                      <td>
                        <div class="badge badge-pill badge-primary"><i class="fas fa-edit"></i></div>
                        <div class="badge badge-pill badge-danger"><i class="fas fa-trash"></i></div>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
    <!-- Custom Js for this page -->




    <?php include 'include/footer.php'; ?>