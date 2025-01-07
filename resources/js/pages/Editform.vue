<template>
    <div class="content-wrapper" style="min-height: 1604.8px">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Vehicle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Vehicle</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle Details</h3>
                            <div class="card-tools">
                                <button
                                    type="button"
                                    class="btn btn-tool"
                                    data-card-widget="collapse"
                                    title="Collapse"
                                >
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <InputText
                                            label="vehicleType"
                                            type="text"
                                            id="vehicleType"
                                            v-model="form.type"
                                            placeholder="e.g., SUV, Sedan, Truck"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <InputText
                                            label="vehicleMake"
                                            type="text"
                                            id="vehicleMake"
                                            v-model="form.make"
                                            placeholder="e.g., Toyota, Ford"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <InputText
                                            label="vehicleModel"
                                            type="text"
                                            id="vehicleModel"
                                            v-model="form.model"
                                            placeholder="e.g., Corolla, Mustang"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <InputText
                                            label="vehicleYear"
                                            type="number"
                                            id="vehicleYear"
                                            v-model="form.year"
                                            placeholder="e.g., 2023"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fuelType"
                                                >Fuel Type</label
                                            >
                                            <select
                                                id="fuelType"
                                                class="form-control custom-select"
                                                v-model="form.fuelType"
                                            >
                                                <option selected disabled>
                                                    Select one
                                                </option>
                                                <option>Diesel</option>
                                                <option>Petrol</option>
                                                <option>Electric</option>
                                                <option>Hybrid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <InputText
                                            label="bodyType"
                                            type="text"
                                            id="bodyType"
                                            v-model="form.bodyType"
                                            placeholder="e.g., Sedan, Hatchback"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <InputText
                                            label="inputVariant"
                                            type="text"
                                            id="inputVariant"
                                            v-model="form.variantT"
                                            placeholder="e.g., SE, XLE"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile"
                                                >File input</label
                                            >
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input
                                                        type="file"
                                                        v-on:change="
                                                            onFileChange
                                                        "
                                                        id="exampleInputFile"
                                                    />
                                                    <label
                                                        class="custom-file-label"
                                                        for="exampleInputFile"
                                                        >{{
                                                            fileName ||
                                                            "Choose file"
                                                        }}</label
                                                    >
                                                </div>
                                            </div>
                                            <div
                                                v-if="imagePreview"
                                                class="image-preview mt-3"
                                            >
                                                <img
                                                    :src="imagePreview"
                                                    alt="Image Preview"
                                                    width="200"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button
                                            @click.prevent="handleSave"
                                            type="submit"
                                            class="btn btn-success"
                                        >
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                type: "",
                make: "",
                model: "",
                year: "",
                fuelType: "",
                bodyType: "",
                variantT: "",
                image: "",
            },
            fileName: "",
            successMessage: "",
            showPopup: false,
            formData: "",
            imagePreview: null,
        };
    },
    mounted() {
        this.getCarData();
    },
    methods: {
        async getCarData() {
            await this.$axios
                .get(`cars/${this.$route.params.id}`)
                .then((response) => {
                    this.form.type = response.data.type;
                    this.form.make = response.data.make;
                    this.form.model = response.data.model;
                    this.form.year = response.data.year;
                    this.form.fuelType = response.data["fuel-type"];
                    this.form.bodyType = response.data["body-type"];
                    this.form.variantT = response.data["variant-t"];
                    this.imagePreview = response.data.imagePath
                        ? "/storage/" + response.data.imagePath
                        : "";
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.image = file;
                console.log(this.form.image);
                this.fileName = file.name; // Store the file name (if needed)
                this.imagePreview = URL.createObjectURL(file); // Generate a preview URL
            } else {
                this.fileName = "";
                this.form.image = "";
                this.imagePreview = null;
            }
        },
        async handleSave() {
            const { image, ...formFields } = this.form;

            // Send request with FormData
            try {
                await this.$axios.put(
                    `/cars/${this.$route.params.id}`,
                    formFields
                );

                if (image) {
                    const formData = new FormData();
                    formData.append("image", image);

                    // Send the image as a separate request
                    await this.$axios.post(
                        `/cars/${this.$route.params.id}/upload-image`,
                        formData,
                        {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        }
                    );
                }

                this.$swal({
                    icon: "success",
                    title: "success",
                    text: "Vehicle added successfully",
                }).then(() => {
                    this.$router.push({ name: "vehicles" });
                });
            } catch (error) {
                this.$swal({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
                console.error("Failed to update car:", error);
                this.successMessage = "";
            }
        },
    },
};
</script>
<style scoped>
.image-preview img {
    border-radius: 5px;
    max-width: 100%;
    height: auto;
}
</style>
