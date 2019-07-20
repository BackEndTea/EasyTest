.PHONY: all
all: cs analysis test

.PHONY: cs
cs: vendor
	vendor/bin/phpcbf && vendor/bin/phpcs

.PHONY: analysis
analysis: psalm phpstan
	composer validate --strict

.PHONY: psalm
psalm: vendor
	vendor/bin/psalm

phpstan: vendor
	vendor/bin/phpstan analyse src -l max

.PHONY: test
test: vendor
	php bin/easytest.php "#src/.*test\.php#"

vendor: $(wildcard composer.lock) composer.json
	composer install

