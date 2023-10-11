<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Agregar</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <form @submit.prevent="addforo">
          <div class="mb-3">
            <label class="form-label">Titulo</label>
            <input type="text" class="form-control" v-model="foro.title" />
          </div>

          <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea
              class="form-control w-100"
              cols="30"
              rows="10"
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
  name: "addforo",
  data() {
    return {
      foro: {
        title: "",
        content: "",
        user_id: ""
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
  mounted() {},
  methods: {
    CleanNumber(numeroString) {
      const numero = parseInt(numeroString, 10); // Convierte la cadena en un número entero
      return numero.toString(); // Convierte el número nuevamente en una cadena
    },
    async addforo() {
      this.foro.user_id = this.info.user_id
      console.log(this.foro.user_id);
      await this.axios
        .post("/api/foro", this.foro)
        .then((response) => {
          console.log(response);
          this.$router.push({ name: "showforo" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
