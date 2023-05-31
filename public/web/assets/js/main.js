$("#hamburger").on("click", function () {
    $("#menuMobile").toggleClass('active');
    $("#bodyContent").toggleClass('overflow-hidden');
});
// Assuming you have a menu with the ID 'menu'
$(document).ready(function () {
    var menu = $('#headerMobile');
    var menuLinks = menu.find('a');

    // Add click event handlers to menu links
    menuLinks.on('click', function () {
        // Close the menu
        $("#menuMobile").toggleClass('active');
        $("#bodyContent").toggleClass('overflow-hidden');
        // Additional actions or logic you want to perform when a link is clicked
    });
});
