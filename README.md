Famill.io
=========

Genealogical tree builder.

Application allows for creation of family trees with detailed biographies for all members. 


## Build status:

| Branch | Build status | Coverage |
|--------|--------------|----------|
| Master | [![build status](https://ci.gitlab.com/projects/3727/status.png?ref=master)](https://ci.gitlab.com/projects/3727?ref=master) | Unknown | 
| Develop | [![build status](https://ci.gitlab.com/projects/3727/status.png?ref=develop)](https://ci.gitlab.com/projects/3727?ref=develop) | Unknown | 

Coverage reports will be available when xDebug will be provided for PHP 7.

## Requirements

* PHP 7

## Project setup

1. Clone the project using git
2. Run composer install
3. Run vagrant up

Detailed instructions can be found in the [Wiki for Famill.io](https://gitlab.com/Famill.io/Famill.io/wikis/home#project-development-quick-start).

## Roadmap

Ultimate goal is to create full featured software with web application to allow for interaction with backend RestFull API. To achieve this goal following steps are needed. Already completed items are not listed.

- Person Domain
    - Person Entity - Started
    - Person related ValueObjects - 70%
    - Persons photos
    - Data Extractors
        - Relations
        - Addresses
        - Locations
    - Facts
        - Relationship related
- Family Domain
    - Family Entity
    - Member Value Object (Person representation in Family domain)
    - Relation model
    - Family Name Value Object