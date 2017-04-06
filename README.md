# utilities
various scripts and utilities
## sicompiler.cpp
    - pass a single C file as argumentt.
        - will search from current folder in all paths for includes and appen it to gcc command
        - will search in /usr/include for includes and add it to gcc command
        - watch it to Ctrl+C it if goes to log....
    - produses the precompiled file as *.out with all macros expanded.
    - also gives you all the missing includes if they are found.
    
