<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <input
            :type="type"
            :id="id"
            class="form-control"
            :value="modelValue"
            :placeholder="placeholder"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>
<script>
export default {
    props: {
        label: {
            type: String,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: "text",
        },
        placeholder: {
            type: String,
            default: "",
        },
        modelValue: {
            type: String,
            default: "",
        },
    },
};
</script>
