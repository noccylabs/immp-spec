immp-spec
=========

IMMP: Internet Mail and Messaging Protocol - Specification and Draft

## Abstract

The protocols that power Internet mail today are ancient, devised back in the
days long before security was a serious issue they lack in a number of aspects,
mainly transport encryption and digital signing/encryption which have been added
later as an afterthought.

This document proposes a new standard for sending and receiving e-mail on the
Internet; IMMP.

## Notes on the Makefile

To add a .dot or .msc image to the draft, add an image link to the markdown
having a .pdf extension. 

      ![My Image](file-from-dot.png)

Then add the source file name to the appropriate line in the Makefile:

      IMGDOT=... file-from-dot.dot

## Join the development process

Use the issue tracker, fork, and send us your pull requests. Who better to help
design the mail protocol of the future but the people that will use it.
