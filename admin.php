<?php include('inc/header.php')?>

<div class="row" style="margin-top:60px;">
    <div class="col-md-6"></div>
    <div class="col-md-6">
    <form class="form-group">
        <input class="admin-search" type="search" placeholder="Search" aria-label="Search">
        <button type="submit" class="btn btn-primary">Search</button>
        <button type="button" class="btn btn-outline-secondary">Student List</button>
        <button type="button" class="btn btn-outline-secondary">Teachers List</button>
    </form>
    
    </div>
</div>

<div class="row" style="margin-top:30px;">
    <div class="col-md-2"></div>

    <div class="col-md-8">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
    </div>


    <div class="col-md-2"></div>
</div>


<?php include('inc/footer.php')?>