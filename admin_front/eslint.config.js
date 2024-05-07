import globals from "globals";
import pluginJs from "@eslint/js";
import pluginVue from "eslint-plugin-vue";


export default [
  {files: ["**/*.js"], languageOptions: {sourceType: "script"}},
  {languageOptions: { globals: globals.browser }},
  pluginJs.configs.recommended,
  {
    ...pluginVue.configs["flat/essential"],
    rules: {
      ...pluginVue.configs["flat/essential"].rules,
      'vue/no-multiple-template-root': 'off',
    },
  },
];