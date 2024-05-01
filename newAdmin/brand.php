<?php include 'include/header.php'; ?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Brand
      </h3>
    </div>

    <div class="contents">
      <div class="row">
        <!-- <div class="col-lg-5">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><b>Add New Brand</b></h4>
              <form class="forms-sample" method="post">
                <div class="form-group">
                  <label for="exampleInputUsername1">Brand Name</label>
                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Brand Name">
                </div>

                <div class="form-group">
                  <label class="d-none mt-4">Upload Brand Logo</label>
                  <input type="file" name="img[]" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Brand Logo">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                  </div>
                </div>

            </div>
            <input type="submit" class="btn btn-primary m-2">

            </form>
          </div>
        </div> -->
        <div class="col-lg-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add New Brand</h4>
              <form class="forms-sample">
                <div class="form-group">
                  <label for="exampleInputName1">Brand Name</label>
                  <input type="text" class="form-control" id="exampleInputName1" placeholder="Brand Name">
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
                <button type="submit" class="btn btn-primary mr-2">Add Brand</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">All Brands</h4>

              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Brand Logo</th>
                      <th>Brand Name</th>
                      <th>Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td><img width="60px " height="60px" alt=""></td>
                      <td> Beximco</td>
                      <td><label class="badge badge-success badge-pill">Active</label></td>
                      <td align="center">
                        <div class="badge badge-pill badge-primary"><i class="fas fa-edit"></i></div>
                        <div class="badge badge-pill badge-danger"><i class="fas fa-trash"></i></div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>



      </div>
      <?php include 'include/footer.php'; ?>