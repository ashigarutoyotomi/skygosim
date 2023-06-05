<template>
    <label class="switch">
        <input
            type="checkbox"
            v-bind="$attrs"
            v-model="itemValue"
        >
        <span class="slider round"></span>
    </label>
</template>

<script>
export default {
    name: "input-toggle",

    props: {
        value: {
            type: String,
            default: () => null,
        },
    },

    data() {
        return {
            itemValue: null,
        }
    },

    created() {
        this.itemValue = this.value !== '0';
    },

    watch: {
        itemValue(value) {
            this.$emit('input', !value ? '0' : '1');
        }
    },

    methods: {
        changed($event) {
            console.log('$event.target.value ', $event.target.value)
            this.$emit('input', $event.target.value);
        }
    }
}
</script>

<style lang="scss">
/* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(16px);
    -ms-transform: translateX(16px);
    transform: translateX(16px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
