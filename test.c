#include <stdio.h>

int main() {
    int x = 4;
    printf("%d", ++x * --x + x++);
    return 0;
}
