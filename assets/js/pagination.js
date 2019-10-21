$(document).ready(function(){
    var categoryId = $('#isSetCategoryId').val();
    getCategory("",categoryId);

    $(document).on("click",".page-link",function(e){
        console.log("usao");
        var page = $(this).data("page");
        var category = $(this).data("category");
        getCategory(page,category);
    });
});

function getCategory(pageId,categoryId){
    $.ajax({
        type: 'POST',
        url: 'models/pagination/paginacija.php',
        dataType: 'json',
        data:{ radnja:'getCategory',id:categoryId,page:pageId},
        success:function(podaci){
            let ispis = "";
            for(let i=0; i<podaci.length; i++){
                ispis += `
                <!-- Single Post -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post wow fadeInUp" data-wow-delay="0.1s">
                        <!-- Post Thumb -->
                        <div class="post-thumb">
                            <img src="`+podaci[i].velika_slika+`" alt="`+podaci[i].alt+` ?>">
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <div class="post-meta d-flex">
                                <div class="post-author-date-area d-flex">
                                    <!-- Post Author -->
                                    <div class="post-author">
                                        <a href="`+podaci[i].href+`">`+podaci[i].fullname+`</a>
                                    </div>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="`+podaci[i].href+`">`+podaci[i].date+`</a>
                                    </div>
                                </div>
                                <!-- Post Comment & Share Area -->
                                <div class="post-comment-share-area d-flex">
                                    <!-- Post Favourite -->
                                    <div class="post-favourite">
                                        <a href="`+podaci[i].href+`"><i class="fa fa-heart-o" aria-hidden="true"></i> `+podaci[i].like_count+`</a>
                                    </div>
                                    <!-- Post Comments -->
                                    <div class="post-comments">
                                        <a href="`+podaci[i].href+`"><i class="fa fa-comment-o" aria-hidden="true"></i> `+podaci[i].comm_count+`</a>
                                    </div>
                                </div>
                            </div>
                            <a href="`+podaci[i].href+`">
                                <h4 class="post-headline">`+podaci[i].headline+`</h4>
                            </a>
                        </div>
                    </div>
                </div>
                `;}
                $('#pagination_data').html(ispis);
        },error:function(greska){
            console.log(greska)
        }
    });
};