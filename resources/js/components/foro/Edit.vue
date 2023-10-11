<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Editar</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <form
          method="POST"
          @submit.prevent="actualize"
          enctype="multipart/form-data"
        >
          <div class="mb-3">
            <label class="form-label">Titulo</label>
            <input type="text" class="form-control" v-model="foro.title" />
          </div>

          <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea
              cols="30"
              rows="10"
              class="form-control w-100"
              v-model="foro.content"
            ></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "editforo",
  data() {
    return {
      foro: {
        title: "",
        content: "",
      },
    };
  },
  computed: {
    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
  },
  mounted() {
    this.showforo();
  },
  methods: {
    CleanNumber(numeroString) {
      const numero = parseInt(numeroString, 10); // Convierte la cadena en un número entero
      return numero.toString(); // Convierte el número nuevamente en una cadena
    },
    async showforo() {
      
      await this.axios
        .get(`/api/foro/${this.$route.params.id}`)
        .then((response) => {
          const { title, content } = response.data;
          (this.foro.title = title), (this.foro.content = content);
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async actualize() {
        this.foro.user_id = this.info.user_id;
      await this.axios
        .put(`/api/foro/${this.$route.params.id}`, this.foro)
        .then((response) => {
          console.log(response.data);
          this.$router.push({
            name: "showforoall",
          });
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>