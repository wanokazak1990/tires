$('.news-slider').slick({
infinite: true,
speed: 300,
slidesToShow: 4,
slidesToScroll: 1,
responsive: [
{
  breakpoint: 1024,
  settings: {
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
  }
},
{
  breakpoint: 700,
  settings: {
    slidesToShow: 1,
    slidesToScroll: 1
  }
}
]
});

$('.feedback-slider').slick({
infinite: true,
speed: 300,
slidesToShow: 3,
slidesToScroll: 1,
responsive: [
{
  breakpoint: 1024,
  settings: {
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
  }
},
{
  breakpoint: 700,
  settings: {
    slidesToShow: 1,
    slidesToScroll: 1
  }
}
]
});