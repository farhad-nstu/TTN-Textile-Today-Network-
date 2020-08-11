<template>
    <div>
        <LeftSidebar/>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >
    
    
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Email Templates</h6>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Code</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="emailTemplate in emailTemplates" v-bind:key="emailTemplate.id">
                  <td>{{ emailTemplate.template_title }}</td>
                  <td>{{ emailTemplate.template_code }}</td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(emailTemplate)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(emailTemplate.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(emailTemplate)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(emailTemplate.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Add new</h6>
          </div>
          <div class="card-body">
            <form @submit.prevent="addUpdate">
              <div class="form-group">
                <label class="req">Title</label>
                <input
                  v-model="template_title"
                  type="text"
                  class="form-control"
                  placeholder
                  required
                />
              </div>

              <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control" v-model="template_code" placeholder />
              </div>

              <div class="form-group">
                <label>From</label>
                <input type="email" class="form-control" v-model="email_from" placeholder />
              </div>

              <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control" v-model="email_subject" placeholder />
              </div>

              <div class="form-group">
                <label>Body</label>
                <textarea type="text" class="form-control" v-model="email_body" placeholder></textarea>
              </div>

              <div v-if="edit == false">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
              <div v-else>
                <button type="submit" class="btn btn-primary">Update</button>
                <button @click="clearForm()" class="btn btn-danger">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  

  </div>
            </div>
        </div>

        <FooterBar/>
    </div>
</template>

<script>
import HeaderBar from '@/components/admin/HeaderBar';
import LeftSidebar from '@/components/admin/LeftSidebar';
import FooterBar from '@/components/admin/FooterBar';

export default {
  name: 'ControllerEmailTemplate',
  components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    },
  data() {
    return {
      emailTemplates: {},
      id: "",
      template_title: "",
      template_code: "",
      email_from: "",
      email_subject: "",
      email_body: "",
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();

      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');

      axios({ method: "GET", url: "/api/email-templates" }).then(
        result => {
          console.log(result.data);
          this.emailTemplates = result.data;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.edit == false) {
        axios
          .post("/api/email-templates", {
            template_title: this.template_title,
            template_code: this.template_code,
            email_from: this.email_from,
            email_subject: this.email_subject,
            email_body: this.email_body
          })
          .then(res => {
            this.clearForm();
            this.getData();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          })
          .catch(er => {
            console.log(err);
          });
      } else {
        //update
        axios
          .put(`/api/email-templates/${this.id}`, {
            template_title: this.template_title,
            template_code: this.template_code,
            email_from: this.email_from,
            email_subject: this.email_subject,
            email_body: this.email_body
          })
          .then(res => {
            this.clearForm();
            this.getData();
            this.edit = false;
            toast.fire({
              icon: "success",
              title: "Updated!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    editData(emailTemplate) {
      this.id = emailTemplate.id;
      this.template_title = emailTemplate.template_title;
      this.template_code = emailTemplate.template_code;
      this.email_from = emailTemplate.email_from;
      this.email_subject = emailTemplate.email_subject;
      this.email_body = emailTemplate.email_body;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/email-templates/${id}`)
          .then(res => {
            this.id = "";
            this.getData();
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    clearForm() {
      this.edit = false;
      this.id = "";
      this.template_title = "";
      this.template_code = "";
      this.email_from = "";
      this.email_subject = "";
      this.email_body = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
