<div class="ftco-section img" style="background-image: url(images/land.jpg);">
     <div class="overlay"></div>
     <div class="container">
         <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
             <div class="col-md-12 text-center">
                 <h2 class="mb-4">Find Your Perfect Stay</h2>
                 <select id="option-selector" class="form-control mb-4" onchange="toggleForms()">
                     <option value="1">Acommodation</option>
                     <option value="2">Hotel + Transportation</option>
                 </select>
             </div>
         </div>

         <div id="selection-form-1" class="filter-form" style="display: block;">
             @include('home.selectionForm1')
         </div>

         <div id="selection-form-2" class="filter-form" style="display: none;">
             @include('home.selectionForm2')
         </div>

         <style>
             #filter-section {
                 position: relative;
             }

             .filter-form {
                 position: relative;
                 z-index: 1;
                 background-color: rgba(255, 255, 255, 0.8);
                 padding: 10px;
                 /* Reduced padding */
                 border-radius: 6px;
                 /* Slightly smaller border radius */
                 box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
             }

             .filter-form h2 {
                 font-size: 1.5em;
                 /* Smaller title */
                 margin-bottom: 10px;
                 /* Reduced margin */
             }

             .form-control {
                 font-size: 0.9em;
                 /* Smaller font size for inputs */
             }

             .price-range-slider {
                 display: flex;
                 flex-direction: column;
                 gap: 5px;
                 /* Add some space between inputs */
             }

             .image-slider {
                 margin-top: 10px;
                 /* Reduced margin */
             }

             .image-item {
                 width: 100%;
                 height: 150px;
                 /* Reduced height */
                 background-size: cover;
                 background-position: center;
             }
         </style>


         <script>
             function toggleForms() {
                 const selectedValue = document.getElementById('option-selector').value;
                 const form1 = document.getElementById('selection-form-1');
                 const form2 = document.getElementById('selection-form-2');

                 if (selectedValue === '1') {
                     form1.style.display = 'block';
                     form2.style.display = 'none';
                 } else {
                     form1.style.display = 'none';
                     form2.style.display = 'block';
                 }
             }

             const minSlider = document.getElementById('price-min');
             const maxSlider = document.getElementById('price-max');
             const minValue = document.getElementById('min-value');
             const maxValue = document.getElementById('max-value');

             minSlider.oninput = function() {
                 minValue.innerText = this.value;
                 if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
                     maxSlider.value = minSlider.value;
                 }
             }

             maxSlider.oninput = function() {
                 maxValue.innerText = this.value;
                 if (parseInt(maxSlider.value) < parseInt(minSlider.value)) {
                     minSlider.value = maxSlider.value;
                 }
             }
         </script>
     </div>
 </div>