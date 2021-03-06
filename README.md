## Simple CRM Plugin

This is a sample project with an external API endpoint example + integration with JS front-end.

### Usage

Add your shortcode form at any post. All parameters are optional but are useful to replace the labels at the form.

```
[simple_crm_form name="n" email="e" phone="p" budget="b" msg="m" name-maxlength="10" email-maxlength="10" phone-maxlength="10" budget-maxlength="10" msg-maxlength="10" cols="50" rows="8" success="Ok!"]
```

#### Installation

Run `npm install` and `composer install` to install all dependencies.

The file `package.json` contains all dependencies, special attention to `devDependencies` and `scripts` section.

#### Editor Configuration / EditorConfig

`.editorconfig` defines rules to unify the coding styles in different styles and IDEs. Specifically indent style, end of line and others.

Reference: http://editorconfig.org/

Recommended: install and configure an extension in your favorite editor.

#### Code Formatting / Prettier

`.prettierrc` uses Prettier, an opinated code formatting, this way we don't worry about setting our own code formatting rules.

Reference: https://prettier.io/

Recommended: install and configure an extension in your favorite editor.

#### Code Quality / ESLint

`.eslintrc.json` uses ESLint to warn us about bad practices in the code, like non-used vars and many others best practices.

Reference: https://eslint.org/

Recommended: install and configure an extension in your favorite editor.
