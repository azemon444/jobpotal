<template>
  <div class="job-component container-fluid px-3 px-md-4">
    <div class="row g-4">
      <!-- Sidebar Column -->
      <div class="col-12 col-md-4 col-xl-3">
        <Sidebar
          @update-filters="updateFilters"
        />
      </div>

      <!-- Main Content Column -->
      <div class="col-12 col-md-8 col-xl-9">
        <!-- No Results State -->
        <div v-if="posts.data.length < 1" class="card shadow-lg border-0 text-center py-5">
          <div class="card-body">
            <div class="mb-4">
              <img
                src="images/search-not-found.png"
                alt="search-not-found"
                class="img-fluid"
                style="max-width: 200px; opacity: 0.7;"
              />
            </div>
            <h4 class="fw-bold text-body mb-2">No Jobs Found</h4>
            <p class="text-muted mb-0">Please try different search criteria or filters.</p>
          </div>
        </div>

        <!-- Results Card -->
        <div v-else class="card shadow-lg border-0">
          <div class="card-header bg-body border-0 py-3">
            <h5 class="fw-bold text-body mb-0">
              <i class="fas fa-briefcase text-primary me-2"></i>
              Job Results
            </h5>
          </div>

          <div class="card-body p-0">
            <SearchResult
              :posts="posts.data"
              :from="posts.from"
              :to="posts.to"
              :total="posts.total"
            />
          </div>

          <!-- Pagination Footer -->
          <div class="card-footer bg-body border-0 py-4">
            <div class="row align-items-center">
              <div class="col-12 col-md-6 mb-3 mb-md-0">
                <p class="text-muted mb-0 fw-medium">
                  <i class="fas fa-info-circle text-primary me-1"></i>
                  Showing {{ posts.from }}-{{ posts.to }} of {{ posts.total }} jobs
                </p>
              </div>
              <div class="col-12 col-md-6">
                <div class="d-flex justify-content-center justify-content-md-end">
                  <pagination
                    class="custom-pagination m-0"
                    :data="posts"
                    @pagination-change-page="getJobs"
                  ></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "./Sidebar";
import SearchResult from "./SearchResult";

export default {
  name: "job-component",
  components: {
    Sidebar,
    SearchResult,
  },
  data() {
    return {
      posts: [],
    };
  },
  created() {
    this.getJobs();
  },
  data() {
    return {
      posts: [],
      currentFilters: {},
    };
  },
  created() {
    this.getJobs();
  },
  methods: {
    getJobs(page = 1) {
      this.$Progress.start();
      const query = this.getParameterByName("q", window.location.href);
      const company = this.getParameterByName("company_id", window.location.href);

      let params = new URLSearchParams();
      params.append('page', page);

      if (query && query.trim() !== "") {
        params.append('q', query);
      }
      if (company && company.trim() !== "") {
        params.append('company_id', company);
      }

      // Add current filters
      Object.keys(this.currentFilters).forEach(key => {
        if (this.currentFilters[key] && this.currentFilters[key] !== "") {
          params.append(key, this.currentFilters[key]);
        }
      });

      let url = "/api/search?" + params.toString();

      axios
        .get(url)
        .then((res) => res.data)
        .then((data) => {
          this.posts = data;
          this.$Progress.finish();
        })
        .catch((err) => {
          console.log(err.message);
          this.$Progress.fail();
        });
    },
    updateFilters(filters) {
      this.currentFilters = { ...filters };
      this.getJobs(); // Refresh results with new filters
    },
    getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return "";
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    },
  },
};
</script>

<style lang="scss" scoped>
</style>



