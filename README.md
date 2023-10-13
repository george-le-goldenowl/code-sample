# Simple PHP Notification Sender with Design Patterns

This is a simple PHP project that demonstrates the implementation of a notification sender utilizing multiple design patterns such as Adapter, Decoration, and Dependency Injection.

## Getting Started

### Prerequisites

- PHP 7.0 or higher
- Composer

### Installation

1. composer install

## Run test
- make tests

## Design Patterns Used

This project demonstrates the implementation of the following design patterns:

1. **Adapter Pattern**  
   The Adapter pattern is used to convert the interface of a class into another interface clients expect. It allows classes with incompatible interfaces to work together. In this project, the adapter pattern is used to integrate various notification services into a unified interface.

2. **Decoration Pattern**  
   The Decoration pattern is used to dynamically add responsibilities to objects. In this project, the Decoration pattern is utilized to add additional features or behaviors to the notification sender without affecting other objects.

3. **Dependency Injection**  
   Dependency Injection is a design pattern used to implement inversion of control. In this project, it is used to inject dependencies, such as the notification service, into the client classes, making the code more modular, testable, and maintainable.

## Contributors

- George Le

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Design Patterns: Elements of Reusable Object-Oriented Software](https://www.oreilly.com/library/view/design-patterns-elements/0201633612/) - Book by Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides.
