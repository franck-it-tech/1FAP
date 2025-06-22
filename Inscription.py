
# import sys
# import random
# import string

# def generer_mot_de_passe(longueur, mode):
#     if mode == '1':
#         chars = string.ascii_letters
#     elif mode == '2':
#         chars = string.ascii_letters + string.digits
#     elif mode == '3':
#         chars = string.ascii_letters + string.digits + string.punctuation
#     else:
#         return "Mode invalide"

#     return ''.join(random.choice(chars) for _ in range(int(longueur)))

# if __name__ == "__main__":
#     longueur = sys.argv[1]
#     mode = sys.argv[2]
#     print(generer_mot_de_passe(longueur, mode))


import random
import string
import sys

def generate_password(level):
    if level == "1":
        chars = string.ascii_letters  # a-zA-Z
    elif level == "2":
        chars = string.ascii_letters + string.digits  # a-zA-Z0-9
    elif level == "3":
        chars = string.ascii_letters + string.digits + string.punctuation
    else:
        chars = string.ascii_letters

    return ''.join(random.choice(chars) for _ in range(12))

if __name__ == "__main__":
    level = sys.argv[1] if len(sys.argv) > 1 else "1"
    print(generate_password(level))

