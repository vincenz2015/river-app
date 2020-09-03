<template>
  <div>
    <section id="header">
      <div class="header-bg">
        <div class="header-logo">
          <img src="images/river_logo.svg" />
        </div>
        <div class="header-text">Example Demo</div>
      </div>
    </section>
    <div class="page">
      <section id="top">
        <div class="row">
          <div class="col">
            <div class="flex">
              <div class="indent d-none d-sm-none d-md-block">__________</div>
              <div class="content">
                <div class="number">01</div>
                <h1>Heading</h1>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
                <p>
                  <el-row>
                    <el-button>Book Now</el-button>
                  </el-row>
                </p>
              </div>
            </div>
          </div>
          <div class="col d-none d-sm-none d-md-block"></div>
        </div>
      </section>
      <section class="section" id="second">
        <div class>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <img class="hero-image" src="images/image-water.png" />
            </div>
            <div class="col-md-6 col-sm-12 flex pt-50">
              <div class="indent d-none d-sm-none d-md-block">__________</div>
              <div class="content">
                <div class="number">02</div>
                <p class="text-medium">Lorem ipsum dolor sit amet, consetetur.</p>
                <p></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section" id="third">
        <div class="row">
          <div class="col-md-5 col-sm-12">
            <div class="flex">
              <div class="indent d-none d-sm-none d-md-block">__________</div>
              <div class="content">
                <div class="number">03</div>
                <h1>Heading</h1>
                <p class="text-medium">Lorem ipsum dolor sit amet, consetetur.</p>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-sm-12">
            <el-form :model="form" class="pt-110">
              <el-form-item>
                <el-input placeholder="Your name" v-model="form.name"></el-input>
              </el-form-item>
              <el-form-item>
                <el-col :span="11">
                  <el-date-picker
                    type="date"
                    placeholder="Pick a day"
                    v-model="form.date"
                    style="width: 100%;"
                  ></el-date-picker>
                </el-col>
                <el-col :span="2">&nbsp;</el-col>
                <el-col :span="11">
                  <el-time-picker
                    placeholder="Select a time"
                    :picker-options="{format: 'HH:mm'}"
                    v-model="form.time"
                    style="width: 100%;"
                  ></el-time-picker>
                </el-col>
              </el-form-item>
              <el-form-item>
                <el-input type="textarea" v-model="form.message"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button type="primary" @click="submitForm()">Place Booking</el-button>
              </el-form-item>
            </el-form>
            <div v-if="validationErrors">
              <el-alert title="Form error" type="error" :description="validationErrors"></el-alert>
            </div>
          </div>
        </div>
      </section>
      <section class="section" id="bookings">
        <div v-if="currentBookings">
          <div class="row">
            <div
              v-for="(value, propertyName, index) in currentBookings"
              class="booking-item col-md-4 col-sm-12 flex"
            >
              <div class="indent d-none d-sm-none d-md-block">______</div>
              <div class="content">
                <div class="number">02</div>
                <div class="booking-title">
                  <div class="booking-name">{{ value.name }}</div>
                  <div class="booking-date">{{ value.date }}</div>
                  <div class="booking-time">{{ value.time }}</div>
                  <div class="booking-message">{{ value.message }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div id="watermark">
        <img src="images/river_wave.svg" />
      </div>
    </div>
    <section class="section" id="footer">
      <div class="row f-header">
        <div class="col-md col-sm-12">*</div>
        <div class="col-md col-sm-12">MENU</div>
        <div class="col-md col-sm-12">MENU</div>
        <div class="col-md col-sm-12">MENU</div>
        <div class="col-md col-sm-12">MENU</div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: "",
        date: "",
        time: "",
        message: "",
      },
      currentBookings: {},
      validationErrors: "",
    };
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      this.getBookings();
    },
    getBookings() {
      let self = this;
      axios.get("/bookings").then(function (response) {
        self.currentBookings = response.data;
      });
    },
    getErrors(err) {
      let errors = Object.values(err);
      errors = errors.flat()[0];
      return errors;
    },
    afterFormSubmit(response) {
      if (response.status == 200) {
        console.log(response);
      }
    },
    afterFormSubmitError(error) {
      if (error.response.status == 422) {
        this.validationErrors = this.getErrors(error.response.data.errors);
      }
    },

    submitForm() {
      this.validationErrors = "";
      let formData = this.form;
      let self = this;
      axios
        .post("/bookings", {
          name: formData.name,
          date: formData.date,
          time: formData.time,
          message: formData.message,
        })
        .then(function (response) {
          self.afterFormSubmit(response);
        })
        .catch(function (error) {
          self.afterFormSubmitError(error);
        });
    },
  },
};
</script>
<style>
/* Global */
#watermark {
  position: absolute;
  bottom: 50px;
  right: 80px;
}
/* Form */
.el-button--primary {
  background-color: #000 !important;
}
body {
  font-family: "Montserrat", sans-serif;
}
p {
  padding-top: 30px;
}
.section {
  padding-top: 10vw;
}
.page {
  padding: 12vw;
  position: relative;
}
.flex {
  display: flex;
}
h1 {
  font-size: 30px;
  font-weight: 600;
  text-transform: uppercase;
}
.pt-50 {
  padding-top: 50px;
}
.pt-110 {
  padding-top: 110px;
}
.text-medium {
  font-family: "Montserrat", sans-serif;
  font-weight: 300;
  font-size: 28px;
}
.booking-item {
  padding-bottom: 80px;
}
.booking-title {
  color: #000;
  font-family: "Montserrat", sans-serif;
  font-weight: 300;
  font-size: 18px;
}
.booking-message {
  margin-top: 30px;
  color: #000;
  font-family: "Montserrat", sans-serif;
  font-weight: 400;
  font-size: 16px;
}
.number {
  font-size: 16px;
  color: #9a9a9a;
}
.el-button span {
  padding: 5px 50px;
}
.indent {
  text-align: right;
  width: 95px;
  margin-top: 90px;
  padding-right: 30px;
}
</style>
</style>
<style scoped>
.header-bg {
  display: flex;
  align-items: center;
  width: 100%;
  height: 150vh;
  max-height: 960px;
  background-image: url("/images/topbg.jpg");
  background-size: cover;
}
@media (max-width: 576px) {
  .header-bg {
    height: 80vh;
  }
}
.header-logo {
  position: absolute;
  align-self: flex-start;
  padding: 50px 0 0 50px;
}
.header-text {
  margin: 0 auto;
  font-family: Montserrat;
  font-weight: bold;
  font-size: 5.5vw;
  text-transform: uppercase;
  letter-spacing: 9.8px;
  color: #fff;
  text-shadow: 0px 3px 6px #00000029;
}

#second .hero-image {
  max-width: 690px;
  width: 100%;
}
#second .indent {
  margin-top: 60px;
}
#third .indent {
  margin-top: 105px;
}
#bookings .indent {
  margin-top: 136px;
}
#footer {
  padding: 80px 50px 150px 150px;
  background-color: #000;
}
#footer .f-header {
  color: #fff;
}
</style>