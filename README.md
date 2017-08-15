# utilities
various scripts and utilities
## sicompiler.cpp
    - Pass a single C file as argumentt.
        - will search from current folder in all subfolders for includes and append it to gcc command
        - will search in /usr/include for includes and add it to gcc command
        - watch it to Ctrl+C it if goes forever ....
    - Produses the precompiled file as *.out with all macros expanded.
    - Also gives you all the missing include files.
    
