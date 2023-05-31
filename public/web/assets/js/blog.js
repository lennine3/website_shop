$("#toc-blog").on("load", function () {
    const count_toc_blog = $("#toc-blog li").length;
    if (count_toc_blog <= 0) {
        $("#toc-content").remove();
    } else {
        const urlPath = window.location.pathname;
        const str = $("#toc-blog").html();
        const strNew = str.replaceAll('href="', 'href="' + urlPath);
        $("#toc-blog").html(strNew);
    }
});

$("#tocAccordion").on("show.bs.collapse", function () {
    $(".toc-accordion-btn i").css("transform", "rotate(0deg)");
    $("#tocText").html('Thu gọn');
});
$("#tocAccordion").on("hide.bs.collapse", function () {
    $(".toc-accordion-btn i").css("transform", "rotate(-180deg)");
    $("#tocText").html('Mở rộng');
});

