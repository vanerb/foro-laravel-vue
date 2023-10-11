<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">
        <h1 class="text-center">{{ foro.title }}</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 offset-3">
        <p>{{ foro.content }}</p>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-6 offset-3">
        <p><b>Respuestas: </b></p>
        <div class="row" v-for="comment in comments" :key="comment.id">
          <div class="col-md-12">
            <p>
              <i class="fa-solid fa-user fs-6"></i>
              <small
                >{{ getUserById(CleanNumber(comment.user_id)) }} -
                {{ getFecha(comment.created_at) }}</small
              >
            </p>
            <p>{{ comment.content }}</p>

            <a class="link-opacity-100" href="#" @click="responder(comment.id)"
              >Responder</a
            >
            <hr />
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5" v-if="isLoggedIn">
      <div class="col-md-6 offset-3">
        <form @submit.prevent="addComment">
          <div class="mb-3">
            <label class="form-label">Comentario</label>
            <textarea
              class="form-control w-100"
              cols="30"
              rows="2"
              v-model="comment.content"
            ></textarea>
            <button type="submit" class="btn btn-success mt-2 float-end">
              Enviar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      foro: [],
      comments: [],
      comment: {
        content: "",
        user_id: "",
        foro_id: "",
      },
      users: [],
    };
  },
  mounted() {
    this.showForo();
    this.showComment();
    this.showUsers();
  },
  computed: {
    isLoggedIn() {
      // Puedes utilizar alguna lógica para determinar si el usuario está autenticado
      // Por ejemplo, comprobar si existe una variable de usuario en el almacenamiento local
      return sessionStorage.getItem("user") !== null;
    },

    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
    isAdmin() {
      if (this.isLoggedIn) {
        if (this.info.user_id == 1) {
          return true;
        } else {
          return false;
        }
      }
    },
  },
  methods: {
    getFecha(fecha) {
      const d = new Date(fecha);
      var day = d.getUTCDate();
      var month = d.getUTCMonth() + 1;
      var year = d.getUTCFullYear();
      const dateformat = day + "/" + month + "/" + year;
      return dateformat;
    },
    CleanNumber(numeroString) {
      const numero = parseInt(numeroString, 10); // Convierte la cadena en un número entero
      return numero.toString(); // Convierte el número nuevamente en una cadena
    },
    getUserById(userId) {
      const userIdToName = {};
      this.users.forEach((user) => {
        userIdToName[user.id] = user.name;
      });

      // Utiliza el mapeo para obtener el nombre de la categoría
      const userName = userIdToName[userId];

      return userName ? userName : "N/A";
    },
    async showUsers() {
      await this.axios
        .get("/api/user")
        .then((response) => {
          this.users = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          this.users = [];
        });
    },
    async showForo() {
      await this.axios
        .get(`/api/foro/${this.$route.params.id}`)
        .then((response) => {
          this.foro = response.data;
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async showComment() {
      await this.axios
        .get(`/api/comment`, { params: { foro_id: this.$route.params.id } })
        .then((response) => {
          this.comments = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async addComment() {
      this.comment.foro_id = this.$route.params.id;
      this.comment.user_id = this.info.user_id;
      await this.axios
        .post(`/api/comment`, this.comment)
        .then((response) => {
          this.comment.content = "";
          this.showComment();
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async responder(id) {
      await this.axios
        .get(`/api/comment/${id}`)
        .then((response) => {
          this.comment.content = " | re: " + response.data.content + " | ";
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>