<div class="cover_area">
  <div class="opacity"></div>
  <div class="cover_main container">
    <div class="cover_inner">
      <div class="title">
        <h1 class="text-center">Search The Best Home</h1>
      </div>
      <div class="search_area">
        <div class="search_main">
          <form class="search_cover" action="availablehouse.php" method="get">
            <div class="address_cover">
              <input type="text" name="address" class="form-control" value="" placeholder="Address">
            </div>
            <div class="rent_type">
                <select class="form-control" style="background-color:lavender;" name="house_type">
                <option value="" selected disabled>Rent Type</option>
                <option value="Family">Family</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Sublet">Sub-Let</option>
                <option value="Mess/Hostel">Hostel/Mess</option>
              </select>
              </div>

            <div id="range_cover">
              <label for="input_range_cover">Price range:</label>
              <input type="text" id="input_range_cover" name="rental_value" readonly style="border:0; color:#f6931f; font-weight:bold;">
              <div id="main_range_cover" class="" title="Tap left or right button to set more precise value."></div>
            </div>

            <p class="text-center"><input type="submit" name="search_cover" class="btn btn-info" value="Search house"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
