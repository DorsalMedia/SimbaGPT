
<?php
require_once('admin-functions.php');

?>
<!--Initialize Header section and css files-->
<?php echo get_header(); ?>
</div>


<div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            Invoice
          </h1>
        </div>
        <div class="invoice">
          <div class="row">
            <div class="col-lg-12">
              <div class="row invoice-header">
                <div class="col-md-6">
                  <img style="width: 20%;" src="<?php echo base_url() ?>assets/images/logo.png" />
                </div>
                <div class="col-md-6 text-right">
                  <h2>
                    #4815162342
                  </h2>
                  <p>
                  <?php 
                    echo date("l jS \, F Y") . "<br>";
                  ?>  
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="well">
                <strong>TO</strong>
                <h3>
                  John Smith Corp.
                </h3>
                <p>
                  1234 Main Street<br>Suite 37<br>Washington, D.C. 20007<br>202.555.5555<br>johnsmith@gmail.com
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="well">
                <strong>FROM</strong>
                <h3>
                  Rydlr
                </h3>
                <p>
                  1234 Main Street<br>Floor 2<br>Baltimore, MD 30010<br>301.555.5555<br>sharpandnimble@gmail.com
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                  <table class="table table-striped invoice-table">
                    <thead>
                      <th width="50"></th>
                      <th>
                        Product
                      </th>
                      <th width="70">
                        Qty
                      </th>
                      <th width="100">
                        Unit Price
                      </th>
                      <th width="100">
                        Total
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          #1
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                      <tr>
                        <td>
                          #2
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                      <tr>
                        <td>
                          #3
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                      <tr>
                        <td>
                          #4
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td class="text-right" colspan="4">
                          <strong>Subtotal</strong>
                        </td>
                        <td>
                          $1,000
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="4">
                          <strong>Tax</strong>
                        </td>
                        <td>
                          $70
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="4">
                          <strong>Shipping</strong>
                        </td>
                        <td>
                          $30
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="4">
                          <h4 class="text-primary">
                            Total
                          </h4>
                        </td>
                        <td>
                          <h4 class="text-primary">
                            $1,100
                          </h4>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>NOTES</strong>
                <p>
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <a class="btn btn-primary pull-right" onclick="javascript:window.print();"><i class="fa fa-print"></i>Print invoice</a>
            </div>
          </div>
        </div>
    </div>


<?php echo get_footer(); ?>