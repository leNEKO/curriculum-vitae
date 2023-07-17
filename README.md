# Curriculum Vitae

Source code for <http://leneko.github.io>

## Run

Replace `{path/to/cv.yml}` with a valid yaml cv data file

```shell
cargo run -- build {path/to/cv.yml}
```

## Build

Update index.html

```shell
cargo make index
```

## Schemas

Update yaml validation schemas

```shell
cargo make schemas
```

## Dev

```shell
cargo make dev
```
