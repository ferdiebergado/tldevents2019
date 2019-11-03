<template>
  <div>
    <input
      v-model.lazy.trim="search"
      type="text"
      class="form-control mt-4"
      placeholder="Search..."
      @keyup.enter="doSearch()"
      autofocus
    />
    <div class="mt-3">
      <label v-if="searching">Searching...</label>
      <p v-else-if="isFinished" :class="hasRecords ? 'text-success':'text-danger'">
        Found
        <strong>{{ results.length }}</strong> participant(s).
      </p>
    </div>

    <div v-if="error" class="alert alert-danger" role="alert">{{ error }}</div>

    <table v-if="hasRecords" class="table table-responsive table-sm mt-3">
      <thead>
        <tr>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>MI</th>
          <th>Sex</th>
          <th>Station</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Task(s)</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="!isFinished">
          <td class="text-center">Searching...</td>
        </tr>
        <tr v-for="result in results" v-else :key="result.id">
          <td scope="row" v-html="highlight(result.last_name)"></td>
          <td v-html="highlight(result.first_name)"></td>
          <td>{{ result.mi }}</td>
          <td>{{ result.sex }}</td>
          <td v-html="highlight(result.station)"></td>
          <td v-html="highlight(result.mobile)"></td>
          <td v-html="highlight(result.email)"></td>
          <td>
            <a
              v-if="result.edit_url !== ''"
              class="btn btn-sm btn-success"
              :href="baseUrl + '/' + result.id + '/addtoevent'"
              role="button"
              title="Add to Event"
            >
              <i class="icon-plus"></i> ADD
            </a>
            <span v-else class="badge badge-success">ADDED</span>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="row">
      <div class="col">
        <p v-if="!searching && isFinished" class="bg-light">
          &nbsp;Participant not in the list? Click
          <a :href="newurl">here</a>.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "ParticipantSearch",
  props: {
    url: {
      type: String,
      default: ""
    },
    createurl: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      search: "",
      results: [],
      baseUrl: this.url,
      newurl: this.createurl,
      isFirstLoad: true,
      isFinished: false,
      error: "",
      searching: false
    };
  },
  computed: {
    escapedSearch() {
      return this.escapeRegExp(this.search.trim());
    },
    hasRecords() {
      return this.results && this.results.length > 0;
    }
  },
  methods: {
    doSearch() {
      this.searching = true;
      if (!this.search) return;
      this.isFinished = false;
      this.isFirstLoad = false;
      this.error = "";
      axios
        .get(this.baseUrl, { params: { search: this.escapedSearch } })
        .then(res => {
          this.results = res.data.data;
          this.searching = false;
        })
        .catch(e => {
          this.error = e.response.data;
        });
      this.isFinished = true;
    },
    highlight(t) {
      if (!this.search) {
        return t;
      }
      const alphanum = this.escapedSearch.trim().replace(/[\W_]+/g, " ");
      const unspaced = alphanum.replace(new RegExp(/\s+(?=\s)/), "");
      const words = unspaced.split(" ");

      if (words.length > 1) {
        for (let index = 0; index < words.length; index++) {
          if (words[index] !== "") {
            t = t.replace(new RegExp(words[index], "gi"), match => {
              return '<span class="highlight">' + match + "</span>";
            });
          }
        }
        return t;
      }
      return t.replace(new RegExp(unspaced, "gi"), match => {
        return '<span class="highlight">' + match + "</span>";
      });
    },
    escapeRegExp(text) {
      return text.replace(/[-[\]{}()*+?.\\/^$|#]/g, "\\$&");
    }
  }
};
</script>