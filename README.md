# IMMP: Internet Mail and Messaging Protocol - Specification and Draft

The protocols that power Internet mail today are ancient, devised back in the
days long before security was a serious issue they lack in a number of aspects,
mainly transport encryption and digital signing/encryption which have been added
later as an afterthought.

This document proposes a new standard for sending and receiving e-mail on the
Internet; IMMP.

## Notes on editing

Don't edit the .md file in the root, but rather the appropriate section in the
`spec/` folder. The `Makefile` regenerates the `immp-*.md` file as needed.

## Notes on the Makefile

To add a .dot or .msc image to the draft, add it as a regular image link. The
makefile will ensure that the images are properly generated.

      ![My Image](file.dot)

Note: This is done by the `tools/mdimages.php` script, which requires php5-cli
to be installed (version 5.4 min).

## Join the development process

Use the issue tracker, fork, and send us your pull requests. Who better to help
design the mail protocol of the future but the people that will use it.
