<div class="container1" id="bodyleft">

    <?php if(!isset($_GET['cat_id'])) { ?>

      <div id="slider">
          <h2>Deals Of The Day</h2>
          <img class="mySlides w3-animate-top" src="../images/slider/a_1.png" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-bottom" src="../images/slider/1.11.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-fading" src="../images/slider/6.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-fading" src="../images/slider/7.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-top" src="../images/slider/8.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-bottom" src="../images/slider/9.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-fading" src="../images/slider/10.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-top" src="../images/slider/11.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-fading" src="../images/slider/12.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-bottom" src="../images/slider/13.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-top" src="../images/slider/14.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-fading" src="../images/slider/15.jpg" style="width:100%" style = "height:20%">
          <img class="mySlides w3-animate-bottom" src="../images/slider/16.jpg" style="width:100%" style = "height:20%">
      </div>
      <script>
          var myIndex = 0;
          carousel();

          function carousel() {
              var i;
              var x = document.getElementsByClassName("mySlides");
              for (i = 0; i < x.length; i++) {
                  x[i].style.display = "none";
              }
              myIndex++;
              if (myIndex > x.length) {myIndex = 1}
              x[myIndex-1].style.display = "block";
              setTimeout(carousel, 5000);
          }
      </script>

        <ul><?php echo vegetables(); ?></ul><br clear='all' />
        <ul><?php echo meat(); ?></ul><br clear='all' />
        <ul><?php echo fish(); ?></ul><br clear='all' />
        <ul><?php echo rice(); ?></ul><br clear='all' />
        <ul><?php echo gas(); ?></ul><br clear='all' />
        

    <?php } ?>

</div>
