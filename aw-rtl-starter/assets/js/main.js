(function(){
  'use strict';

  document.addEventListener('DOMContentLoaded', function(){
    // Mobile menu toggle
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.main-navigation');
    if(toggle && nav){
      toggle.addEventListener('click', function(e){
        e.preventDefault();
        nav.classList.toggle('open');
        toggle.setAttribute('aria-expanded', nav.classList.contains('open'));
      });
    }

    // Simple portfolio filter (data-filter on buttons)
    var filters = document.querySelectorAll('[data-portfolio-filter]');
    if(filters.length){
      var grid = document.querySelector('.portfolio-grid');
      filters.forEach(function(btn){
        btn.addEventListener('click', function(){
          var filter = btn.getAttribute('data-portfolio-filter');
          var items = grid ? grid.querySelectorAll('.portfolio-item') : [];
          items.forEach(function(it){
            if(filter === '*' || it.classList.contains('cat-'+filter)){
              it.style.display = '';
            } else {
              it.style.display = 'none';
            }
          });
          // Manage active state
          filters.forEach(function(b){b.classList.remove('active')});
          btn.classList.add('active');
        });
      });
    }

  });

})();
