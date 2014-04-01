## git-cvs-keywords 
---

  - utility and git hooks for processing text files with cvs-style keywords (`$Id$`, etc.)
 

<br/>
<br/>

### Objective
---
  + to provide automated _and_ manual tools for updating CVS-style `$Keywords$` in text files.
  + autonation provided via git hooks.


<br/>

---

### **Documentation**

---

Start here to read all of the documentation, or jump to [Supported Keywords](#supported-keywords).

---


  + Scripts 
    + `git-process-keywords` - process a single file and update its Keywords.  _unimplemented_

----

  + Classes 
      + TODO AAA
----

  + Functions
      + TODO AAA
-----


### Supported Keywords

  + All Ketwords are in the format `$Keyword$` or `$Keyword: data $` and will be updated with these two formats in mind.
  + Note the *space* between `data` and the ending `$`.

  <ul>
   <li> _`Authoor`_ - auhtor of changes </li>
   <li>_ `Date`_ - daate sa reported by git </li>
   <li> _`Header`_ - file header </li>
   <li> _`Tags`_ - somma-seperated list of git tags </li>
   <li> _`Revision` _- revision hash of current repository.</li>
  </ul>


