<template>
  <section class="search-bar py-5">
    <div class="container-fluid px-3 px-md-4">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <!-- Search Form -->
          <div class="card shadow-lg border-0 mb-4 bg-body">
            <div class="card-body p-4">
              <form @submit.prevent="searchByTitle">
                <div class="input-group input-group-lg">
                  <input
                    type="text"
                    name="q"
                    class="form-control form-control-lg border-end-0"
                    placeholder="Search for jobs by title, company, or keywords..."
                    v-model="jobTitle"
                    style="border-radius: 0.5rem 0 0 0.5rem;"
                  />
                  <button
                    class="btn btn-primary px-4"
                    type="submit"
                    style="border-radius: 0 0.5rem 0.5rem 0;"
                  >
                    <i class="fas fa-search me-2"></i>Search Jobs
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Navigation Links -->
          <div class="text-center">
            <div class="row g-2 justify-content-center">
              <div class="col-6 col-md-3">
                <router-link to="/" class="btn btn-outline-primary btn-sm w-100">
                  <i class="fas fa-list me-1"></i>All Jobs
                </router-link>
              </div>
              <div class="col-6 col-md-3">
                <router-link to="/jobs-by-organization" class="btn btn-outline-primary btn-sm w-100">
                  <i class="fas fa-building me-1"></i>By Company
                </router-link>
              </div>
              <div class="col-6 col-md-3">
                <router-link to="/jobs-by-category" class="btn btn-outline-primary btn-sm w-100">
                  <i class="fas fa-tags me-1"></i>By Category
                </router-link>
              </div>
              <div class="col-6 col-md-3">
                <router-link to="/jobs-by-title" class="btn btn-outline-primary btn-sm w-100">
                  <i class="fas fa-font me-1"></i>By Title
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "search-bar",
  data() {
    return {
      jobTitle: null,
    };
  },
  mounted() {
    const q = this.getParameterByName("q", window.location.href);
    if (q !== "") {
      this.jobTitle = q;
    }
  },
  methods: {
    searchByTitle() {
      if (this.jobTitle.trim() != "") {
        this.$emit("searchByTitle", this.jobTitle);
      }
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

<style scoped>
.search-bar {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 300px;
  display: flex;
  align-items: center;
}

.card {
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-outline-primary {
  border-color: rgba(24, 90, 145, 0.3);
  color: #185a91;
  background: rgba(255, 255, 255, 0.9);
  &:hover {
    background: #185a91;
    border-color: #185a91;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(24, 90, 145, 0.3);
  }
}

@media (max-width: 768px) {
  .search-bar {
    padding: 2rem 0;
    min-height: auto;
  }

  .input-group-lg .form-control {
    font-size: 1rem;
    padding: 0.5rem 1rem;
  }

  .btn {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }
}
</style>
