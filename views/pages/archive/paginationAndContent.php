<!-- ****** Breadcumb Area Start ****** -->
<div class="breadcumb-area" style="background-image: url(assets/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Archive Page</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Archive Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->
    <?php
    if(isset($_GET['category_id'])) $id=$_GET['category_id']; else $id="";
    echo '<input type="hidden" id="isSetCategoryId" value="'.$id.'"/>';
    include ABSOLUTE_PATH.'/models/pagination/paginacija.php';
    $number_of_results = ($id!="") ? rowCountId(intval($id)) : countRow();
    $results_per_page = 6;
    $number_of_pages = ceil($number_of_results/$results_per_page);
    ?>
    <!-- ****** Archive Area Start ****** -->
    <section class="archive-area section_padding_80">
        <div class="container">
            <div class="row" id="pagination_data"></div>
                    <div class="col-12">
                        <div class="pagination-area d-sm-flex mt-15">
                            <nav aria-label="#">
                                <ul class="pagination">
                                    <?php for($page=1; $page<=$number_of_pages; $page++): ?>
                                    <li class="page-item active">
                                        <?php if(isset($id)): ?>    
                                        <a class="page-link" data-page=<?=$page?> data-category=<?=$id?>><?= $page; ?></a>
                                        <?php else: ?>
                                        <a class="page-link" data-page=<?=$page?>><?= $page; ?></a>
                                        <?php endif; ?>
                                    </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
        </div>
    </section>