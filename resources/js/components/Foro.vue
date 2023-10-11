<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Foro</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-2" v-for="foro in foros" :key="foro.id">
          <router-link
            :to="{
              name: 'showitem',
              params: { id: foro.id },
            }"
          >
            <div class="card-header">
              <h1>{{ foro.title }}</h1>
            </div>
          </router-link>
          <div class="card-footer">
            <small
              >{{ getFecha(foro.created_at) }} -
              {{ getUserById(CleanNumber(foro.user_id)) }}</small
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "foro",
  data() {
    return {
      foros: [],
      users: [],
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
    this.showForo();
    this.showUsers();
  },
  methods: {
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
    getFecha(fecha) {
      const d = new Date(fecha);
      var day = d.getUTCDate();
      var month = d.getUTCMonth() + 1;
      var year = d.getUTCFullYear();
      const dateformat = day + "/" + month + "/" + year;
      return dateformat;
    },
    async showForo() {
      await this.axios
        .get("/api/foroall")
        .then((response) => {
          this.foros = response.data;
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
