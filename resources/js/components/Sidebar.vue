<template>
  <div>
    <div class="card shadow-lg border-0 mb-4">
      <div class="card-header bg-body border-0 py-3">
        <div class="d-flex align-items-center mb-0">
          <i class="fas fa-filter text-primary me-2 fs-5"></i>
          <h6 class="fw-bold text-body mb-0">Refine Your Job Search</h6>
        </div>
        <button
          class="btn btn-outline-primary btn-sm d-md-none mt-2"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#accordion"
          aria-expanded="true"
          aria-controls="accordion"
        >
          <i class="fas fa-sliders-h me-1"></i> Filters
        </button>
      </div>
    </div>
    <div id="accordion" class="collapse show">
      <div class="card shadow-lg border-0">
        <div class="card-body p-4" id="jobCategories">
          <!-- Job Categories -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-tags text-primary me-2"></i>Job Categories
            </h6>
            <select
              name="job_category"
              class="form-select form-select-sm"
              @change="filterCategory($event)"
            >
              <option value="">All Categories</option>
              <option
                v-for="category in categories"
                :value="category.id"
                :key="category.id"
              >
                {{ category.category_name }}
              </option>
            </select>
          </div>

          <!-- Location -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-map-marker-alt text-primary me-2"></i>Location
            </h6>
            <input
              type="text"
              class="form-control form-control-sm"
              placeholder="Enter location"
              v-model="filters.location"
              @input="updateFilters"
            />
          </div>

          <!-- Salary Range -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-dollar-sign text-primary me-2"></i>Salary Range
            </h6>
            <div class="row g-2">
              <div class="col-6">
                <input
                  type="number"
                  class="form-control form-control-sm"
                  placeholder="Min"
                  v-model="filters.min_salary"
                  @input="updateFilters"
                />
              </div>
              <div class="col-6">
                <input
                  type="number"
                  class="form-control form-control-sm"
                  placeholder="Max"
                  v-model="filters.max_salary"
                  @input="updateFilters"
                />
              </div>
            </div>
          </div>

          <!-- Job Level -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-level-up-alt text-primary me-2"></i>Job Level
            </h6>
            <select
              name="job_level"
              class="form-select form-select-sm"
              v-model="filters.job_level"
              @change="updateFilters"
            >
              <option value="">All Levels</option>
              <option value="Entry level">Entry level</option>
              <option value="Mid level">Mid level</option>
              <option value="Senior level">Senior level</option>
              <option value="Top level">Top level</option>
            </select>
          </div>

          <!-- Education -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-graduation-cap text-primary me-2"></i>Education
            </h6>
            <select
              name="education_level"
              class="form-select form-select-sm"
              v-model="filters.education_level"
              @change="updateFilters"
            >
              <option value="">All Education Levels</option>
              <option value="SEE Mid School">SEE Mid School</option>
              <option value="High School">High School</option>
              <option value="Bachelors">Bachelors</option>
              <option value="Master">Master</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <!-- Employment Type -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-briefcase text-primary me-2"></i>Employment Type
            </h6>
            <select
              name="employment_type"
              class="form-select form-select-sm"
              v-model="filters.employment_type"
              @change="updateFilters"
            >
              <option value="">All Types</option>
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
              <option value="Freelance">Freelance</option>
              <option value="Internship">Internship</option>
              <option value="Trainneship">Trainneship</option>
              <option value="Volunter">Volunter</option>
            </select>
          </div>

          <!-- Experience -->
          <div class="mb-4">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-clock text-primary me-2"></i>Experience (Max Years)
            </h6>
            <input
              type="number"
              class="form-control form-control-sm"
              placeholder="Max experience years"
              v-model="filters.experience_years"
              @input="updateFilters"
            />
          </div>

          <!-- Posted Within -->
          <div class="mb-0">
            <h6 class="fw-semibold text-body mb-3">
              <i class="fas fa-calendar-alt text-primary me-2"></i>Posted Within
            </h6>
            <select
              name="posted_within"
              class="form-select form-select-sm"
              v-model="filters.posted_within"
              @change="updateFilters"
            >
              <option value="">Any time</option>
              <option value="1">Last 24 hours</option>
              <option value="7">Last week</option>
              <option value="30">Last month</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "sidebar-component",
  data() {
    return {
      categories: [],
      filters: {
        category_id: "",
        location: "",
        min_salary: "",
        max_salary: "",
        job_level: "",
        education_level: "",
        employment_type: "",
        experience_years: "",
        posted_within: ""
      }
    };
  },
  mounted() {
    this.setCategoies();
  },
  methods: {
    setCategoies() {
      axios
        .get("/api/company-categories")
        .then((res) => res.data)
        .then((data) => {
          this.categories = JSON.parse(JSON.stringify(data));
        });
    },
    updateFilters() {
      // Emit all current filters
      this.$emit("update-filters", this.filters);
    },
    filterCategory(e) {
      this.filters.category_id = e.target.value;
      this.updateFilters();
    },
  },
};
</script>

<style>
</style>