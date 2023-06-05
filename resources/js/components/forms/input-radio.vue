<template>
    <div
        class="radio-input"
        :class="{'checked': isChecked}"
    >
        <input
            :id="`${label}-${value}`"
            type="radio"
            v-bind="$attrs"
            :checked="isChecked"
            :value="value"
            @change="$emit('change', $event.target.value)"
        >

        <span
            class="checkmark"
            @click="$emit('change', value)"
        ></span>

        <label :for="`${label}-${value}`">{{ label }}</label>
    </div>
</template>

<script>
    export default {
        name: "input-radio",

        inheritAttrs: false,

        model: {
            prop: 'modelValue',
            event: 'change'
        },

        props: {
            label: {
                type: String,
                default: () => null,
            },

            modelValue: {
                type: String,
                default: () => "",
            },

            value: {
                type: Number,
                default: () => null,
            },
        },

        computed: {
            isChecked() {
                return parseInt(this.modelValue) === parseInt(this.value);
            }
        }
    }
</script>

<style lang="scss">
    .radio-input {
        position: relative;

        input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        label:before {
            display: none !important;
        }

        .checkmark {
            border: 2px solid #e1e1e1;
            border-radius: 50%;
            content: "";
            display: inline-block;
            height: 16px;
            margin-bottom: 2px;
            margin-right: 10px;
            vertical-align: middle;
            width: 16px;
            background-color: #fff;
        }

        &.checked {
            .checkmark {
                background-clip: content-box;
                background-color: #4c4c4c;
                padding: 3px;
            }
        }
    }
</style>
