.PHONY: all
all: cs psalm test

.PHONY: cs
cs: vendor
	vendor/bin/phpcbf && vendor/bin/phpcs

.PHONY: psalm
psalm: vendor
	vendor/bin/psalm

.PHONY: test
test: vendor
	php bin/easytest.php "#src/.*test\.php#"

vendor: $(wildcard composer.lock) composer.json
	composer install

