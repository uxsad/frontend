paper.pdf: paper.md
	docker run --rm \
	    --volume $$PWD:/data \
	    --user $$(id -u):$$(id -g) \
	    --env JOURNAL=joss \
	    openjournals/inara \
	    -o pdf \
	    $<
