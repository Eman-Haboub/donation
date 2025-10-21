<style>
  .hero {
    background: url("storage/home/16.webp") no-repeat center center;
    height: 100vh;
    padding-top: 100px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  }

  .search-btn {
    background-color: #ffc107;
    color: #000;
    font-weight: bold;
    border: none;
    transition: all 0.3s ease;
  }

  .search-btn:hover {
    background-color: #e0a800;
    transform: scale(1.05);
  }
</style>

<section>
  <header class="hero d-flex align-items-center text-center text-white">
    <div class="container">
      <h1 class="display-5 fw-bold">
        SUPPORT <span class="text-warning">NEEDY FAMILIES</span><br>
        AND MAKE A REAL CHANGE
      </h1>

      <!-- Search Form -->
      <form method="GET" action="{{ route('search') }}">
            <div class="row mt-4 g-2 justify-content-center">
            <!-- Region -->
            <div class="col-6 col-md-2">
                <select name="region" class="form-select">
                <option value="">Select Region</option>
                <option value="Gaza">Gaza</option>
                <option value="Rafah">Rafah</option>
                <option value="Khan Younis">Khan Younis</option>
                </select>
            </div>

            <!-- Family Members -->
            <div class="col-6 col-md-2">
                <select name="members_count" class="form-select">
                <option value="">Family Size</option>
                <option value="small">1-3</option>
                <option value="medium">4-6</option>
                <option value="large">7+</option>
                </select>
            </div>

            <!-- Need Category -->
            <div class="col-6 col-md-2">
                <select name="category" class="form-select">
                <option value="">Need Category</option>
                <option value="food">Food</option>
                <option value="medicine">Medicine</option>
                <option value="rent">House Rent</option>
                <option value="education">Education</option>
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-6 col-md-2">
                <button type="submit" class="btn search-btn w-100 py-2">
                <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
            </div>
      </form>

      <!-- Quick Categories -->
      <div class="row mt-4 g-3 justify-content-center">
        <div class="col-6 col-md-2">
          <div class="result-card">
            <img src="{{ asset('storage/home/6.jpg') }}" class="img-fluid rounded hedimg" alt="Result">
            <p class="mt-2">Education</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="result-card">
            <img src="{{ asset('storage/home/20.jpg') }}" class="img-fluid rounded hedimg" alt="Result">
            <p class="mt-2">Basic Needs</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="result-card">
            <img src="{{ asset('storage/home/2.jpg') }}" class="img-fluid rounded hedimg" alt="Result">
            <p class="mt-2">Shelter</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="result-card">
            <img src="{{ asset('storage/home/19.png') }}" class="img-fluid rounded hedimg" alt="Result">
            <p class="mt-2">Health</p>
          </div>
        </div>
      </div>
    </div>
  </header>
</section>
