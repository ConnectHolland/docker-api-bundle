# Contibute to Connect Holland Docker API Bundle

Thank you for contributing! To contribute, follow these steps.

1. Modify API specification

   Add configurtation of the endpoint to `src/Resources/config/openapi-spec.yaml`

1. Generate API classes
   Run generate:
   ```bash
   composer generate
   ```

1. Add manual code when needed
   Did you add additional classes manually? Do not forget to run fixer:
   ```bash
   composer fix
   ```

1. Add tests and test the code:
   ```bash
   composer test
   ```

1. Commit your code and create a PR for it.

