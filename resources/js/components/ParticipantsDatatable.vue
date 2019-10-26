<template>
  <vue-bootstrap4-table
    :rows="rows"
    :columns="columns"
    :config="config"
    @refresh-data="fetchData()"
  >
    <template slot="task" slot-scope="props">
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <a
          class="btn btn-sm btn-light"
          :href="'/admin/participants/' + props.row.id"
          role="button"
          title="View"
        >
          <span class="icon-eye"></span>
          View
        </a>
        <a
          class="btn btn-sm btn-primary"
          :href="'/admin/participants/' + props.row.id + '/edit'"
          role="button"
          title="Edit"
        >
          <span class="icon-pencil"></span>
          Edit
        </a>
      </div>
    </template>
  </vue-bootstrap4-table>
</template>

<script>
import VueBootstrap4Table from "vue-bootstrap4-table";
import axios from "axios";

export default {
  name: "ParticipantsDatatable",
  props: {
    participants: {
      type: String,
      default: ""
    }
  },
  data: function() {
    return {
      rows: JSON.parse(this.participants),
      columns: [
        {
          label: "id",
          name: "id",
          filter: {
            type: "simple",
            placeholder: "id"
          },
          sort: true
        },
        {
          label: "Last Name",
          name: "last_name",
          filter: {
            type: "simple",
            placeholder: "Enter last name..."
          },
          sort: true
        },
        {
          label: "First Name",
          name: "first_name",
          filter: {
            type: "simple",
            placeholder: "Enter first name..."
          },
          sort: true
        },
        {
          label: "MI",
          name: "mi",
          sort: true
        },
        {
          label: "Sex",
          name: "sex",
          sort: true
        },
        {
          label: "Station",
          name: "station",
          filter: {
            type: "simple",
            placeholder: "Enter school/office..."
          },
          sort: true
        },
        {
          label: "Mobile",
          name: "mobile",
          filter: {
            type: "simple",
            placeholder: "Enter mobile..."
          },
          sort: true
        },
        {
          label: "Email",
          name: "email",
          filter: {
            type: "simple",
            placeholder: "Enter first name..."
          },
          sort: true
        },
        {
          label: "Task",
          name: "task",
          sort: false
        }
      ],
      config: {
        card_mode: false,
        selected_rows_info: false,
        pagination: true,
        pagination_info: true,
        num_of_visibile_pagination_buttons: 7,
        per_page: 5,
        checkbox_rows: false,
        highlight_row_hover: true,
        rows_selectable: false,
        multi_column_sort: true,
        highlight_row_hover_color: "grey",
        global_search: {
          placeholder: "Search...",
          visibility: true,
          case_sensitive: false
        },
        per_page_options: [5, 10, 20, 25, 50, 100],
        show_refresh_button: true,
        show_reset_button: true,
        server_mode: false,
        preservePageOnDataChange: true,
        loaderText: "Updating..."
      }
    };
  },
  methods: {
    fetchData() {
      axios.get("/admin/participants").then(res => {
        this.rows = res.data.data;
      });
    }
  },
  components: {
    VueBootstrap4Table
  }
};
</script>