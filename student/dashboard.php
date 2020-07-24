<?php require_once ('../inc/connection.php'); ?>
<?php session_start(); ?>
<?php include_once ('stu_header.php'); ?>

<div class="row mt-4">
    <div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 300px">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div class="col-md-2"></div>
    </div>

</div>



<div class="container mt-4">
<div class="row row-cols-1 row-cols-md-4">
    <div class="col mb-4">
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="..." style="min-width: 200px;height: 200px">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="row justify-content-center">
                    <form action="" >
                        <input type="text" placeholder="Enroll Key">
                        <div class="mt-4">
                        <button class=" btn btn-info ">Enroll</button>
                        <button class="btn btn-info ml-2" type="button" data-toggle="modal" data-target="#exampleModal">Read more</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="..." style="min-width: 200px;height: 200px">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="row justify-content-center">
                <form action="" >
                    <input type="text" placeholder="Enroll Key">
                    <div class="mt-4">
                    <button class=" btn btn-info ">Enroll</button>
                    <button class="btn btn-info ml-2 " type="button" data-toggle="modal" data-target="#exampleModal">Read more</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="..." style="min-width: 200px;height: 200px">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                <div class="row justify-content-center">
                    <form action="" >
                        <input type="text" placeholder="Enroll Key">
                        <div class="mt-4">
                        <button class=" btn btn-info ">Enroll</button>
                        <button class="btn btn-info ml-2" type="button" data-toggle="modal" data-target="#exampleModal">Read more</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="..." style="min-width: 200px;height: 200px">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="row justify-content-center">
                    <form action="" >
                        <input type="text" placeholder="Enroll Key">
                        <div class="mt-4">
                        <button class=" btn btn-info">Enroll</button>
                        <button class="btn btn-info ml-2" type="button" data-toggle="modal" data-target="#exampleModal">Read more</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-md-4"></div>
    </div>
</div>




<?php include ('stu_footer.php'); ?>

