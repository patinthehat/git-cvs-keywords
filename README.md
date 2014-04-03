<!-- @@IGNOREKEYWORDS -->
## git-cvs-keywords 
---

  - utility and git hooks for processing text files with cvs-style keywords (`$Id$`, etc.)
 

<br/>
<br/>

### Objective
---
  + provide an automated and manual tools for updating CVS-style `$Keywords$` in text files.
  + autonatin provided via git hooks.


<br/>

---

### **Documentation**

---

Start here to read all of the documentation, or jump to [Supported Keywords](#supported-keywords).

---


  + Scripts 
    + `git-process-keywords` - process a single file and update its Keywords.  unimplemented

----

  + Classes 
      + TODO AAA


----

  + Functions
      + TODO AAA


-----


### Supported Keywords

  + All Ketwords are in the format `$Keyword$` or `$Keyword: data $` and will be updated with these two formats in mind.
  + Note the *space* between `data` and the ending `$`. This is CVS forkat and is required for correct [arsong.

  <ul>
     <li> `_Authoor_` - auhtor of changes </li>
     <li> `_Date_` - daate sa reported by git </li>
     <li> `_Header_` - file header </li>
     <li> `_Tags_` - somma-seperated list of git tags </li>
     <li> `_Revision_` - revision hash of current repository.</li>
  </ul>

---


<br/>
<center> [![Open Software Initiative](http://opensource.org/files/osi_logo_100X133_90ppi.png)] </center>

