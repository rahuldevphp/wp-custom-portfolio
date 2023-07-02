jQuery(document).ready(function ($) {

    $('#load-more-button').on('click', function (e) {
        e.preventDefault();

        var $button = $(this),
            currentPage = $button.data('current-page'),
            totalPages = $button.data('total-pages'),
            postsPerPage = $button.data('posts-per-page');
            featured_image = $button.data('featured-image');

        if (currentPage >= totalPages) {
            $button.remove();
            return;
        }

        $.ajax({
            url: wp_custom_portfolio_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'wp_custom_portfolio_load_more',
                current_page: currentPage,
                total_pages: totalPages,
                posts_per_page: postsPerPage,
                featured_image: featured_image,
            },
            beforeSend: function () {
                $button.text('Loading...');
            },
            success: function (response) {
                $button.text('Load More');
                $('#wp_custom_portfolio_post_list').append(response);
                // $('#load-more-container').before(response);

                $button.data('current-page', currentPage + 1);

                if (currentPage + 1 >= totalPages) {
                    $button.remove();
                }
            },
            error: function () {
                $button.text('Load More');
            }
        });
    });
});

// document.addEventListener('DOMContentLoaded', function() {
jQuery(document).on( 'click','body', function() {
  const portfolioItems = document.querySelectorAll('.portfolio-item');
  const popupOverlay = document.querySelector('.portfolio-popup-overlay');
  const popupImage = document.querySelector('.portfolio-popup-image');
  const popupImagelogo = document.querySelector('.portfolio-popup-image-logo');
  const popupTitle = document.querySelector('.portfolio-popup-title');
  const popupDescriptiontext = document.querySelector('.portfolio-popup-text-name');
  const popupDescription = document.querySelector('.portfolio-popup-description');
  const closePopup = document.querySelector('.close-popup');

  portfolioItems.forEach(function(item) {
    item.addEventListener('click', function() {
      const imageSrc = item.getAttribute('data-image');
      const imagelogoSrc = item.getAttribute('data-image-logo');
      const title = item.querySelector('h3').textContent;
      const textname = item.querySelector('p.text-name').textContent;
      const description = item.querySelector('p.description').textContent;

      popupImage.setAttribute('src', imageSrc);
      popupImagelogo.setAttribute('src', imagelogoSrc);
      popupTitle.textContent = title;
      popupDescriptiontext.textContent = textname;
      popupDescription.textContent = description;

      popupOverlay.style.display = 'flex';
    });
  });

  closePopup.addEventListener('click', function() {
    popupOverlay.style.display = 'none';
  });
});
