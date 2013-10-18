IN=immp-draft.md
OUT=immp-draft.pdf
OPTS=--toc --number-sections --normalize --smart -V geometry="margin=1in" --latex-engine=xelatex

$(OUT): $(IN)
	pandoc $(OPTS) $(IN) -o $(OUT) 
