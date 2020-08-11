<template>
  <div>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      apps: {},
      id: "",
      platform_id: "",
      title: "",
      package_name: "",
      short_descr: "",
      descr: "",
      logo: "",
      promo_video_link: "",
      firebase_api_key: "",
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    takeImage(event) {
      let file = event.target.files[0];

      let reader = new FileReader();
      reader.onload = event => {
        this.logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },

    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "api/apps" }).then(
        result => {
          console.log(result.data);
          this.apps = result.data;
        },
        error => {
          console.error('Not verified');
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.edit == false) {
        axios
          .post("/api/apps", {
            title: this.title,
            platform_id: this.platform_id,
            package_name: this.package_name,
            short_descr: this.short_descr,
            logo: this.logo,
            descr: this.descr,
            firebase_api_key: this.firebase_api_key,
            promo_video_link: this.promo_video_link
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
          .put(`/api/apps/${this.id}`, {
            title: this.title,
            platform_id: this.platform_id,
            package_name: this.package_name,
            short_descr: this.short_descr,
            logo: this.logo,
            descr: this.descr,
            firebase_api_key: this.firebase_api_key,
            promo_video_link: this.promo_video_link
          })
          .then(res => {
            this.clearForm();
            this.getData();
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

    editData(app) {
      this.id = app.id;
      this.title = app.title;
      this.platform_id = app.platform_id;
      this.package_name = app.package_name;
      this.short_descr = app.short_descr;
      this.descr = app.descr;
      this.firebase_api_key = app.firebase_api_key;
      this.promo_video_link = app.promo_video_link;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/apps/${id}`)
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
      this.title = "";
      this.platform_id = "";
      this.package_name = "";
      this.short_descr = "";
      this.descr = "";
      this.logo = "";
      this.firebase_api_key = "";
      this.promo_video_link = "";
      this.$refs.fileInput.value = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
