document.addEventListener('DOMContentLoaded', function () {
    // Fetching carousels
    const upcomingCarousel = document.querySelector('.upcoming-animes .carousel');
    const topRatedCarousel = document.querySelector('.top-rated-animes .carousel');
    const seasonCarousel = document.querySelector('.anime-season .carousel');

    // Fetching arrows
    const leftArrowUpcoming = document.querySelector('.upcoming-animes .left-arrow');
    const rightArrowUpcoming = document.querySelector('.upcoming-animes .right-arrow');

    const leftArrowTopRated = document.querySelector('.top-rated-animes .left-arrow');
    const rightArrowTopRated = document.querySelector('.top-rated-animes .right-arrow');

    const leftArrowSeason = document.querySelector('.anime-season .left-arrow');
    const rightArrowSeason = document.querySelector('.anime-season .right-arrow');

    // Scroll amounts for carousels
    let scrollAmountUpcoming = 0;
    let scrollAmountTopRated = 0;
    let scrollAmountSeason = 0;

    // Function to scroll carousel
    function scrollCarousel(carousel, direction, scrollAmount) {
        const scrollStep = 200; // Scroll by 200px
        const maxScroll = carousel.scrollWidth - carousel.offsetWidth;

        if (direction === 'left') {
            scrollAmount -= scrollStep;
            if (scrollAmount < 0) {
                scrollAmount = maxScroll; // Reset to end when going left
            }
        } else if (direction === 'right') {
            scrollAmount += scrollStep;
            if (scrollAmount > maxScroll) {
                scrollAmount = 0; // Reset to start when going right
            }
        }

        carousel.style.transform = `translateX(-${scrollAmount}px)`;
        return scrollAmount;
    }

    // Add event listeners for upcoming anime arrows
    leftArrowUpcoming.addEventListener('click', () => {
        scrollAmountUpcoming = scrollCarousel(upcomingCarousel, 'left', scrollAmountUpcoming);
    });
    rightArrowUpcoming.addEventListener('click', () => {
        scrollAmountUpcoming = scrollCarousel(upcomingCarousel, 'right', scrollAmountUpcoming);
    });

    // Add event listeners for top-rated anime arrows
    leftArrowTopRated.addEventListener('click', () => {
        scrollAmountTopRated = scrollCarousel(topRatedCarousel, 'left', scrollAmountTopRated);
    });
    rightArrowTopRated.addEventListener('click', () => {
        scrollAmountTopRated = scrollCarousel(topRatedCarousel, 'right', scrollAmountTopRated);
    });

    // Add event listeners for seasonal anime arrows
    leftArrowSeason.addEventListener('click', () => {
        scrollAmountSeason = scrollCarousel(seasonCarousel, 'left', scrollAmountSeason);
    });
    rightArrowSeason.addEventListener('click', () => {
        scrollAmountSeason = scrollCarousel(seasonCarousel, 'right', scrollAmountSeason);
    });

    // Optional: Auto-scroll (all carousels)
    setInterval(() => {
        scrollAmountUpcoming = scrollCarousel(upcomingCarousel, 'right', scrollAmountUpcoming);
        scrollAmountTopRated = scrollCarousel(topRatedCarousel, 'right', scrollAmountTopRated);
        scrollAmountSeason = scrollCarousel(seasonCarousel, 'right', scrollAmountSeason);
    }, 3000); // Adjust timing for auto-scroll (e.g., 3000ms = 3 seconds)
});
